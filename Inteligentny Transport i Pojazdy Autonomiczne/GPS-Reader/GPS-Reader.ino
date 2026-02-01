void setup() {
  Serial2.begin(9600);
}

void loop() {
  while (Serial2.available()) {
    char c = Serial2.read();
  }
}