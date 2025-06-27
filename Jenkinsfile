pipeline {
    agent any

    environment {
        IMAGE_NAME = "laravel-sms-app"
    }

    stages {
        stage('Cloner le code') {
            steps {
                git url: 'https://github.com/tonrepo/tonprojet.git', branch: 'main'
            }
        }

        stage('Construire l’image Docker') {
            steps {
                sh 'docker build -t $IMAGE_NAME .'
            }
        }

        stage('Exécuter les tests') {
            steps {
                sh 'docker run --rm $IMAGE_NAME php artisan test'
            }
        }

        stage('Déployer (dev)') {
            steps {
                echo 'Déploiement sur environnement de test/dev...'
                sh 'docker-compose down && docker-compose up -d --build'
            }
        }
    }

    post {
        failure {
            mail to: 'youssefmaha299@gmail.com',
                 subject: "Échec pipeline Jenkins - Laravel",
                 body: "Le build a échoué."
        }
    }
}
