pipeline {
    agent any

    environment {
        IMAGE_NAME = 'mahayoussef/codelaravel'
    }

    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/mahayoussef12/SMSDigital_Laravel'
            }
        }

        stage('Build docker image') {
            steps {
                bat "docker build -t %IMAGE_NAME%:latest ."
            }
        }

         stage('Connexion Docker Hub') {
         steps {
             withCredentials([usernamePassword(credentialsId: 'docker', usernameVariable: 'DOCKER_USER', passwordVariable: 'DOCKER_PASS')]) {
                 bat """
                     docker login -u %DOCKER_USER% -p %DOCKER_PASS%
                     docker push %IMAGE_NAME%:latest
                     docker logout
                 """
             }
         }
     }

    }
}
