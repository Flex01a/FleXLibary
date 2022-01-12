import requests
from flask import Flask

def send_msg(text):
   token = "1883871949:AAHU-dHbSvQhalGIHTebf1x19llaqqK133o"
   chat_id = "614135975"
   url_req = "https://api.telegram.org/bot" + token + "/sendMessage" + "?chat_id=" + chat_id + "&text=" + text 
   results = requests.get(url_req)
   print(results.json())

send_msg("Hello there!")

if __name__ == "__main__":
    app.run("0.0.0.0", 8519)
