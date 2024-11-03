#!/bin/bash
# Questo script viene utilizzato per inviare l'ip della raspberry ad un canale Telegram
# per evitare di dover cercare l'ip, nel caso la rpi sia configurata con il dhcp
# deve stare /usr/local/bin/ips-send.sh
# Dopo aver creato il bot sostituire ->>
# SOSTITUIRE_CON_GROUP_ID (collegarsi a https://api.telegram.org/bot$BOT_TOKEN/getUpdates e recuperare l'id dal messaggio ricevuto)
# SOSTITURE_CON_BOT_TOKEN

IPS=$(hostname -I)
/usr/bin/curl -s --data "text=Indirizzi ip Rpi:$IPS" --data "chat_id=SOSTITUIRE_CON_GROUP_ID" 'https://api.telegram.org/botSOSTITURE_CON_BOT_TOKEN/sendMessage' > /dev/null


#echo $?
