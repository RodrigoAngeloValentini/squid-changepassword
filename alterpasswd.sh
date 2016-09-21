#!/bin/bash
# Arquivo a ser utilizado para alteração
# by Alam L Colatto e Rodrigo A. Valentini
# Contact: alam.colatto@gmail.com - rodrigoangelovalentini@gmail.com
# version 09/2016

#Arquivo de armazenamento de senhas. (gerado pelo htpasswd)
arq_passwd=./passwd

# Binario htpasswd
htpasswd=/usr/bin/htpasswd

#Verifica existencia do arquivo de senhas
if [ -e $arq_passwd ]
then
  # Efetua validacao da senha passada para o usuario passado
  $htpasswd -vb $arq_passwd $1 $2 >> /dev/null 2>&1
  if [ $? == 0 ]
  then
        # Efetua altearcao da senha do usuario passado
        $htpasswd -b $arq_passwd $1 $3
        echo "true"
  else
        echo "false"
  fi
else
   echo "Arquivo $arq_passwd não foi encontrado."
fi
