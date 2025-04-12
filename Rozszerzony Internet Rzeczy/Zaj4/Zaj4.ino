#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
const char* ssid = "WiFi";
const char* password = "super_tajne_haslo";
const int ledPin = 5;
ESP8266WebServer server(80);
void handleOn() {
  digitalWrite(ledPin, HIGH);
  server.send(200, "text/plain", "LED ON"); Serial.println("Włączono diodę! (świeci)");
}
void handleOff() {
  digitalWrite(ledPin, LOW);
  server.send(200, "text/plain", "LED OFF"); Serial.println("Wyłączono diodę! (nie świeci)");
}
void setup() {
  pinMode(ledPin, OUTPUT);
  digitalWrite(ledPin, LOW);
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  Serial.print("Łączenie z WiFi...");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nPołączono z WiFi!");
  Serial.print("Adres IP: ");
  Serial.println(WiFi.localIP());
  server.on("/on", handleOn);
  server.on("/off", handleOff);
  server.onNotFound([]() {
    server.send(404, "text/plain", "Nie znaleziono strony");
  });
  server.begin();
  Serial.println("Serwer HTTP uruchomiony");
}
void loop() {
  server.handleClient();
}
