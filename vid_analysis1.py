import cv2
import mediapipe as mp
import numpy as np
from ultralytics import YOLO


"""This Video analysis code uses Mediapipe and YOLO"""
# Load YOLO model for ID card detection
model = YOLO('id_50_best.pt')

# Initialize MediaPipe Face Mesh & Pose
mp_face_mesh = mp.solutions.face_mesh
mp_pose = mp.solutions.pose

face_mesh = mp_face_mesh.FaceMesh(min_detection_confidence=0.5, min_tracking_confidence=0.5)
pose = mp_pose.Pose(min_detection_confidence=0.5, min_tracking_confidence=0.5)

# Open webcam or video file
video_source = r"path_to_your_video" # Change to "your_video.mp4" for a video file, keep as 0 for realtime processing
cap = cv2.VideoCapture(video_source)

# Score tracking variables
frame_count = 0
eye_contact_count = 0
posture_count = 0
id_card_detected = 0

while cap.isOpened():
    ret, frame = cap.read()
    if not ret:
        print("Video feed ended, exiting...")
        break  # Exit if no frame is received

    frame_count += 1
    h, w, _ = frame.shape
    rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)

    # ---- Eye Contact Detection using Face Mesh ----
    face_results = face_mesh.process(rgb_frame)
    if face_results.multi_face_landmarks:
        eye_contact_count += 1  # Face detected, assume eye contact
        for face_landmarks in face_results.multi_face_landmarks:
            for idx in [33, 133, 362, 263]:  # Indices for eyes
                x, y = int(face_landmarks.landmark[idx].x * w), int(face_landmarks.landmark[idx].y * h)
                cv2.circle(frame, (x, y), 3, (0, 255, 0), -1)  # Draw eye landmarks

    # ---- Posture Detection using Pose Estimation ----
    pose_results = pose.process(rgb_frame)
    if pose_results.pose_landmarks:
        posture_count += 1  # Good posture detected
        for landmark in pose_results.pose_landmarks.landmark:
            px, py = int(landmark.x * w), int(landmark.y * h)
            cv2.circle(frame, (px, py), 3, (255, 0, 0), -1)  # Draw pose landmarks

    # ---- ID Card Detection using YOLO ----
    yolo_results = model(frame)
    for result in yolo_results:
        for box in result.boxes:
            if box.conf[0] > 0.4:  # Confidence threshold
                class_id = int(box.cls[0])  # Get class ID
                if class_id == 0:  # Assuming ID card class is 0
                    id_card_detected += 1
                    x1, y1, x2, y2 = map(int, box.xyxy[0])
                    cv2.rectangle(frame, (x1, y1), (x2, y2), (0, 255, 255), 2)  # Draw ID card box
                    cv2.putText(frame, "ID Card", (x1, y1 - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 255, 255), 2)

    # ---- Real-time Score Calculation ----
    eye_score = (eye_contact_count / frame_count) * 40
    posture_score = (posture_count / frame_count) * 30
    id_card_score = (id_card_detected / frame_count) * 30
    video_analysis_score = eye_score + posture_score + id_card_score

    # Display Scores
    cv2.putText(frame, f"Eye Contact: {eye_score:.2f}/40", (10, 30), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 255, 0), 2)
    cv2.putText(frame, f"Posture Score: {posture_score:.2f}/30", (10, 60), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (255, 0, 255), 2)
    cv2.putText(frame, f"ID Card Score: {id_card_score:.2f}/30", (10, 90), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 255, 255), 2)
    cv2.putText(frame, f"Total Score: {video_analysis_score:.2f}/100", (10, 120), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 0), 2)

    # Show live video
    cv2.imshow("Live Video Analysis", frame)

    # Press 'q' to exit
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()

print(eye_score) 
print(posture_score)
print(id_card_score) 
print(video_analysis_score)  