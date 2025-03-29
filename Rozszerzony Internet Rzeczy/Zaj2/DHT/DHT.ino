#include <DHT.h>

#define DHTPIN 7
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);

void setup() {
    Serial.begin(115200);
    dht.begin();
}

void loop() {
    float humidity = dht.readHumidity();
    float temperature = dht.readTemperature();
    if (isnan(humidity) || isnan(temperature)) {
        Serial.println("Błąd odczytu z czujnika DHT11!");
        return;
    }
    Serial.print("Wilgotność: ");
    Serial.print(humidity);
    Serial.print("%  Temperatura: ");
    Serial.print(temperature);
    Serial.println("°C");
    delay(2000);
}
