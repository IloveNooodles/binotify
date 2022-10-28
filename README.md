# Binotify - Spotify like app

Binotify is a spotify like monolithic web application made using PHP and vanilla html css js. This app This repository is made to fulfill Tugas Besar 1 Pengembangan Aplikasi Berbasis Web IF3110 2022/2023. This app is also using docker for easy of use and same environment. Also includes with mysql and phpmyadmin for easier database management. This app have auth feature, see list of song and albums, searching, and many more. Currently this app supports thee role admin, user, and guest mode.

Made with ❤ with

|              Name              |   NIM    |
| :----------------------------: | :------: |
| Muhammad Garebaldhie ER Rahman | 13520029 |
|        I Gede Arya R. P        | 13520036 |
|      Arik Rayi Arkananta       | 13520048 |

## Screenshot

## User Functionality

1. All user

   - Listen song
   - See list of song
   - See detail of song
   - Searching with pagination
     - by title
     - by author (penyanyi)
     - by tahun terbit
     - filtered by genre
   - See list album
   - See detail album

2. Guest Mode

   - Listen song (limit 3x per day)

3. User

   - Auth
     - Register
     - Login
     - Logout
   - Listen song (no limit)

4. Admin
   - User managament
     - See list user
   - Song management
     - Insert Song
     - Delete Song
     - Change Song detail (but not duration and album)
   - Album Management
     - Add album
     - Delete album
     - Change album detail
     - Add song to album
     - Remove song from album

## Requirement list

1. Docker
2. Php 8

## Installation

1. Install requirements

   - For window and mac user

     - Download docker desktop [here](https://www.docker.com/products/docker-desktop/)

   - For UNIX like user run commands below

   ```sh
    sudo apt-get update
    sudo apt-get install docker-ce docker-ce-cli containerd.io docker-compose-plugin
   ```

   To verify if docker is already installed run with `docker run hello-world` and for UNIX users don't forget to add `sudo`

2. Clone this repository
3. By default this application use port `8001, 8002, 8003` and if your computer already use the port please change it in `docker-compose.yml` file and you can refer to guide in [here](https://docs.docker.com/compose/gettingstarted/)

## How to run

1. Change directory to the clonned repo
2. Create `.env` file by using the example
3. Fill `MYSQL_USER, MYSQL_PASSWORD, MYSQL_ROOT_PASSWORD, MYSQL_DATABASE` in your `.env` file
   1. You can fill it with anything you would like for example
   ```env
   MYSQL_USER=binotify
   MYSQL_PASSWORD=binotify
   MYSQL_ROOT_PASSWORD=binotify
   MYSQL_DATABASE=binotify
   ```
4. Run `./scripts/run.sh` to start the applications
5. Run `./scripts/shutdown.sh` to shutdown the applications
6. If it seems the application response with an error try to run `./scripts/build-image.sh` and then `./scripts/run.sh`

NOTE: If you are UNIX users don't forget to add sudo (ex: `sudo ./scripts/run.sh`)

## How are the tasks divided?

### Server side

| Muhammad Garebaldhie ER Rahman      | I Gede Arya R. P | Arik Rayi Arkananta        |
| ----------------------------------- | :--------------: | -------------------------- |
| login                               |   Insert song    | register & AJAX validation |
| fetch list user                     |   Insert album   | fetch list album           |
| fetch list song                     |    Edit Song     | fetch detail song          |
| create song, albums, and user model |    Edit Album    | play music mechanism       |
| upload file mechanism               |    Detail Song     |             |
| count song duration mechanism       |    Detail Album     |             |
| docker                              |    Delete Song     |             |
|                                     |    Delete Album     |             |
|                                     |    Get All Genre     |             |
|                                     |    Add Song to Album     |             |
|                                     |    Delete Song from Album     |             |
|                                     |    Get Unlinked Song     |             |

### Client Side

| Muhammad Garebaldhie ER Rahman | I Gede Arya R. P  | Arik Rayi Arkananta          |
| ------------------------------ | :---------------: | ---------------------------- |
| Responsive user list page      | Insert song page  | Navbar user, guest and admin |
| list of song in home           | Insert album page | Homepage                     |
| base css and animation         |                   | Register                     |
| responsive list of album page  |                   | Login                        |
| admin list user page           |                   | Detail song (Song Player)    |
| Song search and pagination     |                   | Album Page                   |
|                                |                   | Detail album                 |
|                                |                   | Edit Album                   |
|                                |                   | Edit Song                    |
|                                |                   | Delete Confirmations         |
|                                |                   |