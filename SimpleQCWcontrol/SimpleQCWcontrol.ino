#include "SimpleESP32servers.h"

void customHandleWebSocketsText(uint8_t *payload) {
    String message = String( (char *)payload );
    Serial.println("handleWebSocketsText: "+message);

    StaticJsonDocument<200> doc;
    deserializeJson(doc, payload);
    byte byte1 = doc["BytesToFPGA"][0];
    Serial.println(byte1);
}

SimpleESP32servers simpleESP32servers;
void setup(){
    simpleESP32servers.startWiFiAndServers(
            "ESP32 Access Point",
            "bomb4065"
    );
}

void loop(){
    simpleESP32servers.runRoutine();
}
