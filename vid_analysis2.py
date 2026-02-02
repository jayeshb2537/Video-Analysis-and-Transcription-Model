import cv2
import numpy as np
from ultralytics import YOLO

# Load YOLO model for ID card detection
model = YOLO('id_50_best.pt')

# Load Haar Cascade classifiers for face, eye, and posture detection
face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
eye_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_eye.xml')
upper_body_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_upperbody.xml')

# Open webcam or video file
video_source = r"path_to_your_video" #keep as 0 for realtime video
cap = cv2.VideoCapture(video_source)

# Score tracking variables
frame_count = 0
face_count = 0
eye_contact_count = 0
posture_count = 0
id_card_detected = 0

while cap.isOpened():
    ret, frame = cap.read()
    if not ret:
        break
    frame_count += 1

    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

    # ---- Face Detection ----
    faces = face_cascade.detectMultiScale(gray, 1.3, 5)
    if len(faces) > 0:
        face_count += 1

    for (x, y, w, h) in faces:
        cv2.rectangle(frame, (x, y), (x + w, y + h), (255, 0, 0), 2)  # Draw face rectangle
        face_roi = gray[y:y+h, x:x+w]

        # ---- Eye Contact Detection ----
        eyes = eye_cascade.detectMultiScale(face_roi)
        if len(eyes) >= 2:  # If both eyes detected
            eye_contact_count += 1
        for (ex, ey, ew, eh) in eyes:
            cv2.rectangle(frame, (x+ex, y+ey), (x+ex+ew, y+ey+eh), (0, 255, 0), 2)  # Draw eyes

    # ---- Posture Detection ----
    upper_bodies = upper_body_cascade.detectMultiScale(gray, 1.1, 3)
    if len(upper_bodies) > 0:
        posture_count += 1
        for (ux, uy, uw, uh) in upper_bodies:
            cv2.rectangle(frame, (ux, uy), (ux + uw, uy + uh), (0, 0, 255), 2)  # Draw posture box

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
    face_score = (face_count / frame_count) * 25
    eye_score = (eye_contact_count / frame_count) * 25
    posture_score = (posture_count / frame_count) * 20
    id_card_score = (id_card_detected / frame_count) * 30  # ID detection has higher weight
    video_analysis_score = face_score + eye_score + posture_score + id_card_score

    # Display Scores
    cv2.putText(frame, f"Face Score: {face_score:.2f}/25", (10, 30), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (255, 0, 0), 2)
    cv2.putText(frame, f"Eye Contact: {eye_score:.2f}/25", (10, 60), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 255, 0), 2)
    cv2.putText(frame, f"Posture Score: {posture_score:.2f}/20", (10, 90), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 0, 255), 2)
    cv2.putText(frame, f"ID Card Score: {id_card_score:.2f}/30", (10, 120), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 255, 255), 2)
    cv2.putText(frame, f"Total Score: {video_analysis_score:.2f}/100", (10, 150), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 0), 2)

    # Show live video
    cv2.imshow("Live Video Analysis", frame)

    # Press 'q' to exit
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()
