import requests

print("""

 ▀█▀ █▀▀ █░░ █▀▀ █▀▄ ▄▀▄ ▀█▀
 ░█░ █▀▀ █░▄ █▀▀ █▀█ █░█ ░█░
 ░▀░ ▀▀▀ ▀▀▀ ▀▀▀ ▀▀░ ░▀░ ░▀░


""")


def send_msg(text,toke,chatid):
   token = toke
   chat_id = chatid
   url_req = "https://api.telegram.org/bot" + token + "/sendMessage" + "?chat_id=" + chat_id + "&text=" + text 
   results = requests.get(url_req)
   print(results.json())

s1 = input("BotToken : ")

s2 = input(" ChatID : ")

s3 = input(" Message : ") 





send_msg(s3,s1,s2)
