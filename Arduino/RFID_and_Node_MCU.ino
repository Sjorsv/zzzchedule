//#include <Time.h>
//#include <TimeLib.h>

#include <SPI.h>
#include <MFRC522.h>
#include <HTTPClient.h>
#include <iostream> 
#include <string>
//#include <ESP8266WiFi.h>
//#include <Tone.h>

#define SS_PIN 5
#define RST_PIN 22

#define ERROR_PIN 26
#define SUCCESS_PIN 27

#define BUZZER_PIN 25
//#define BUZZER_CHANNEL 0

//int freq = 2000;
//int channel = 0;
//int resolution = 8;

String payload = "Geel";
String loopflag = "0";
//const int SUCCES_PIN = 27;
//#define CONN_PIN D8


const char *ssid = "Platjouw"; 
const char *password = "bloem1963";

MFRC522 mfrc522(SS_PIN, RST_PIN);
void setup() {
   delay(1000);
   Serial.begin(9600);
   WiFi.mode(WIFI_OFF);    
   delay(1000);
   WiFi.mode(WIFI_STA);
   WiFi.begin(ssid, password);
   Serial.println("");



//   pinMode(CONN_PIN, OUTPUT);
   pinMode(SUCCESS_PIN, OUTPUT);
   pinMode(ERROR_PIN, OUTPUT);
   pinMode(BUZZER_PIN, OUTPUT);
   
   Serial.print("Connecting");
   while (WiFi.status() != WL_CONNECTED) {
     delay(500);
     Serial.print(".");
   }

   Serial.println("");
   Serial.print("Connected to ");
   Serial.println(ssid);
   Serial.print("IP address: ");
   Serial.println(WiFi.localIP()); 
   
   SPI.begin();
   mfrc522.PCD_Init();
}

void sendRfidLog(long cardId) {
  
  if(WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    String postData = "cardid=" + String(cardId) + "&action=insertRfIdLog"; // slaat string op in postData var
    //http.begin("http://192.168.0.10/rfid/log.php");       
    //http.begin("http://192.168.0.10/rfid/log.php?cardid=%22+String(cardId)");  
    http.begin("https://studenthome.hku.nl/~sjors.platjouw/rfid/log.php"); 
    http.begin("https://studenthome.hku.nl/~sjors.platjouw/rfid/viewlogs.php"); 
    http.begin("https://studenthome.hku.nl/~sjors.platjouw/rfid/log.php?cardid=%22+String(cardId)");     
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");  
    
    int httpCode = http.POST (postData);  //Send the request
//    int httpCode = http.GET (getData);  //Send the request
    String response = http.getString();
//    Serial.println(httpCode); // print the request
    payload = response;

    http.end();
    
 

    
    //led1

//    if(payload.equals("success")) {
//     digitalWrite(SUCCESS_PIN, HIGH);
//    } else {
//     digitalWrite(ERROR_PIN, HIGH);
//    }

   
  }
}

//void toggleConnStat() {
//  if(WiFi.status() == WL_CONNECTED) {
//    digitalWrite(CONN_PIN, HIGH);
//  } else {
//    digitalWrite(CONN_PIN, LOW);
//  }
//}

void loop() {
  
if ( mfrc522.PICC_IsNewCardPresent()){
    if ( mfrc522.PICC_ReadCardSerial()){
      long code=0;
      for (byte i = 0; i < mfrc522.uid.size; i++){
        code=((code+mfrc522.uid.uidByte[i])*10);
      }
      sendRfidLog(code);
      //mfrc522.PICC_DumpToSerial(&(mfrc522.uid));
    }
  }

     if (payload.equals("Rood")) {
        // Rood
        digitalWrite (ERROR_PIN, HIGH);  // turn on the LED
        delay(1000); // wait for half a second or 500 milliseconds
        digitalWrite (ERROR_PIN, LOW); // turn off the LED
        Serial.println("Rood lampje gaat aan");
        delay(500);
     
        payload = "Geel";   
    } 
    
    if (payload.equals("Groen")) {
        digitalWrite (SUCCESS_PIN, HIGH);  // turn on the LED
        delay(1000); // wait for half a second or 500 milliseconds
        digitalWrite (SUCCESS_PIN, LOW); // turn off the LED
        Serial.println("Groen lampje gaat aan");
        delay(500);
         
        payload = "Geel";
    }
    

  
  if(loopflag.equals("0")) {
      HTTPClient client;
      String url = "https://studenthome.hku.nl/~sjors.platjouw/rfid/alarmtime.php";
      client.begin(url);
      int httpResultcode = client.GET();
      if (httpResultcode == HTTP_CODE_OK) {
          String response = client.getString();
          Serial.println(response);
          loopflag = response;
          
        if (loopflag.equals("1")) { 
          digitalWrite(ERROR_PIN, HIGH);
          for (int i=0; i <= 15; i++) {
          digitalWrite (BUZZER_PIN, HIGH); // Send 1KHz sound signal...
          delay(1000);        // ...for 1 sec
          digitalWrite(BUZZER_PIN, LOW);     // Stop sound...
          delay(1000);        // ...for 1sec
           if (mfrc522.PICC_IsNewCardPresent()){
            digitalWrite(ERROR_PIN, LOW);
            digitalWrite(SUCCESS_PIN, HIGH);
            delay(500);
            digitalWrite(SUCCESS_PIN, LOW);
            cli(); //disable interrupts
            while(1); //forever loop
                 // Stop sound...
                 
           }
        }
        }

    }
}

  
 // toggleConnStat();
  delay (2000);
//  
//  digitalWrite(SUCCESS_PIN, LOW);
//  digitalWrite(ERROR_PIN, LOW);
     
}
