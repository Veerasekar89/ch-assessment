Assessment
===================

Setup
-----

Folder structure

```
chope
??? Dockerfile
??? docker-compose.yml
??? script.sh
??? script.sh
??? UML-diagram.pdf
??? app
?   ??? composer.json
?   ??? composer.lock
?   ??? .env

```


Installation
--------------------------

1. Install docker with latest version 
  https://docs.docker.com/engine/install/ 

2. Clone the Repository

  `$ cd assessment` \
  `$ git clone https://github.com/Veerasekar89/ch-assessment.git . `

3. Copy sample /app/.env.dev file into /app/.env and modify it.

  `$ cp /app/.env.dev /app/.env`

4. Start Docker.

  `$ docker-compose up -d`

5. SSH into php container.

  `$ sh /script.sh`

