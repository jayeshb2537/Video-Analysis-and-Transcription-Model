import cv2
import mediapipe as mp
import numpy as np
import threading
from ultralytics import YOLO

# Load YOLO model for ID card detection
model = YOLO('id_50_best.pt')

# Initialize MediaPipe Face Mesh & Pose
mp_face_mesh = mp.solutions.face_mesh
mp_pose = mp.solutions.pose

face_mesh = mp_face_mesh.FaceMesh(static_image_mode=False, max_num_faces=1, min_detection_confidence=0.5, min_tracking_confidence=0.5)
pose = mp_pose.Pose(static_image_mode=False, min_detection_confidence=0.5, min_tracking_confidence=0.5)

# Open video source
video_source = r"path_to_your_video" #keep as 0 for realtime video
cap = cv2.VideoCapture(video_source)

frame_count = 0
eye_contact_count = 0
posture_count = 0
id_card_detected = 0
lock = threading.Lock()

def process_face_pose(rgb_frame):
    """Processes face mesh and pose estimation on a given frame."""
    global eye_contact_count, posture_count

    face_results = face_mesh.process(rgb_frame)
    if face_results.multi_face_landmarks:
        with lock:
            eye_contact_count += 1  # Eye contact detected

    pose_results = pose.process(rgb_frame)
    if pose_results.pose_landmarks:
        with lock:
            posture_count += 1  # Posture detected

def process_yolo(frame):
    """Runs YOLO model for ID card detection."""
    global id_card_detected

    results = model(frame, verbose=False)
    for result in results:
        for box in result.boxes:
            if box.conf[0] > 0.4:  # Confidence threshold
                class_id = int(box.cls[0])  # Get class ID
                if class_id == 0:  # Assuming ID card class is 0
                    with lock:
                        id_card_detected += 1

# Process every Nth frame for YOLO to speed up performance
YOLO_FRAME_SKIP = 5
frame_skip = 0

while cap.isOpened():
    ret, frame = cap.read()
    if not ret:
        print("Video feed ended, exiting...")
        break  # Exit if no frame is received

    frame_count += 1
    rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)

    # Multi-threading for face & pose processing
    face_pose_thread = threading.Thread(target=process_face_pose, args=(rgb_frame,))
    face_pose_thread.start()

    # YOLO processing every Nth frame
    if frame_skip == 0:
        yolo_thread = threading.Thread(target=process_yolo, args=(frame,))
        yolo_thread.start()
        frame_skip = YOLO_FRAME_SKIP
    else:
        frame_skip -= 1

    face_pose_thread.join()
    if frame_skip == YOLO_FRAME_SKIP:
        yolo_thread.join()

cap.release()

# ---- Final Score Calculation ----
eye_score = (eye_contact_count / frame_count) * 40
posture_score = (posture_count / frame_count) * 30
id_card_score = (id_card_detected / frame_count) * 30
video_analysis_score = eye_score + posture_score + id_card_score
print(eye_score) 
print(posture_score)
print(id_card_score) 
print(video_analysis_score)  