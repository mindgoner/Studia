const int photoResistorPin = A1; 
const int ledPin = A2; 

void setup() {
  pinMode(ledPin, OUTPUT); 
  pinMode(photoResistorPin, INPUT); 
  Serial.begin(115200); 
}

void loop() {
  int sensorValue = analogRead(photoResistorPin); 
  
  if (sensorValue > 100) { // Ok 
    analogWrite(ledPin, 420); 
    Serial.print(sensorValue); 
    Serial.println("SWIECI SIE!");
  } else {
    analogWrite(ledPin, 0);
    Serial.print(sensorValue); 
    Serial.println("ZGASLA!");
  }
  
  delay(500);
}
