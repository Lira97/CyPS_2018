#Matar todos los contenedores corriendo:
docker kill $(docker ps -q)
#Mostrar los contenedores
docker ps -a -q
#Eliminar todos los contenedores
docker rm $(docker ps -a -q)
#Correr el docker-compose
docker-compose up
#Entrar a terminal de cada contenedor
sudo docker exec -i -t (idDelContenedor) /bin/bash
#Eliminar todas las imagenes
docker rmi $(docker images -q)
