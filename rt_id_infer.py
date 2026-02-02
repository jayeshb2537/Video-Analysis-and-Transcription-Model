from ultralytics import YOLO 

model = YOLO('id_50_best.pt')

results = model(source=0, show = True, conf = 0.4, save=True)