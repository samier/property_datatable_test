## Property Test

#### Steps of installing the project

- Clone the repository in your local and switch to development branch
- Go to the project directory and Install the laravel dependencies using below command

       composer update

- Similarlly install the node dependencies for VueJS using below command

      npm install

- Copy the **.env.example** file and rename it to just **.env**
- Set the appropriate database connection in **.env** file

      APP_URL=<PROJECT_URL>
      DB_CONNECTION=mysql
      DB_HOST=<DB_HOST>
      DB_PORT=3306
      DB_DATABASE=<DBNAME>
      DB_USERNAME=<DB_USER>
      DB_PASSWORD=<DB_PASSWORD>

     If you are using the virtual host then give the path to public folder.

- After setting the database connections, Run below command to create the tables.

      php artisan migrate

- After that seed the database with default values using below command.

      php artisan db:seed

- Run below command to generate the application key

      php artisan key:generate

- If the OS is linux then don't forgot to give permission to storage folder

      sudo chmod -R 0777 storage/

- Run below command once to start the project in browser

      npm run dev

- Now the application is running. Move to the browser and open the URL provided in the **.env** file in the key **APP_URL**
