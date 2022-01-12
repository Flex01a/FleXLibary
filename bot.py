import requests
from flask import Flask


def send_msg(text):
   token = "your_token"
   chat_id = "your_chatId"
   url_req = "https://api.telegram.org/bot" + token + "/sendMessage" + "?chat_id=" + chat_id + "&text=" + text 
   results = requests.get(url_req)
   print(results.json())

send_msg("Hello there!")

if __name__ == "__main__":
    app.run("0.0.0.0", 8519)

