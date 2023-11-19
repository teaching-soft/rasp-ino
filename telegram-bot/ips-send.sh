#!/bin/bash
# Questo script viene utilizzato per inviare l'ip della raspberry ad un canale Telegram
# per evitare di dover cercare l'ip, nel caso la rpi sia configurata con il dhcp
# deve stare /usr/local/bin/ips-send.sh

GROUP_ID=$1
BOT_TOKEN=$2

IPS=$(hostname -I)

#echo $IPS

curl -s --data "text=Indirizzi ip Rpi:$IPS" --data "chat_id=$GROUP_ID" 'https://api.telegram.org/bot'$BOT_TOKEN'/sendMessage' > /dev/null
#echo $?

