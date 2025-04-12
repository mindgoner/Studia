// ESP8266 Blinker
// Dodajemy do plytek link z definicja EPS8266 w "File > Preferences > Additional Boards managers URL":
// http://arduino.esp8266.com/stable/package_esp8266com_index.json

void setup() {
  pinMode(LED_BUILTIN, OUTPUT);
}

void loop() {
  // Wlacz diode
  digitalWrite(LED_BUILTIN, LOW);
  delay(500);

  // Wylacz diode
  digitalWrite(LED_BUILTIN, HIGH);
  delay(500);
}
