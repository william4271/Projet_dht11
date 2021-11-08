
#include "WiFi.h"
#include "DHT.h"


#define DHTPIN 4     // Port de connection de capteur
#define DHTTYPE DHT11   

const char* ssid     = "";
const char* password = "";
const char* host = "";

DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(115200);
  Serial.println(F("DHT11 test!"));
  dht.begin();

  Serial.println();
  Serial.println();
  Serial.print("Connection de la wifi");
  Serial.println(ssid);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
       delay(500);
        Serial.print(".");
    }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}
   


void loop() {
  // Temps de pose de chaque lecture
  delay(600000);

  float humidite = dht.readHumidity();
  float temperature = dht.readTemperature();

  if (isnan(humidite) || isnan(temperature)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
  else{

   Serial.print("Humidite: ");
  Serial.print(humidite);
  Serial.print(" %\t");
  Serial.print("%  Temperature: ");
  Serial.print(temperature);
  Serial.print("°C ");
  }
 Serial.print("connecting to ");
 Serial.println(host);
WiFiClient client;
    const int httpPort = 80;
    if (!client.connect(host, httpPort)) {
        Serial.println("connection failed");
        return;
    }
 client.print(String("GET http:///projet_capteur/sauvegarde_mesure.php?") + 
                          ("&temperature=") + temperature +
                          ("&humidite=") + humidite +
                          " HTTP/1.0\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
    unsigned long timeout = millis();
    while (client.available() == 0) {
        if (millis() - timeout > 1000) {
            Serial.println(">>> Client Timeout !");
            client.stop();
            return;
        }
    }

    // Read all the lines of the reply from server and print them to Serial
    while(client.available()) {
        String line = client.readStringUntil('\r');
        Serial.print(line);
        
    }

    Serial.println();
    Serial.println("closing connection");
}
  
