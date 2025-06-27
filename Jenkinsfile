pipeline {
    agent any

    environment {
        IMAGE_NAME = "laravel-sms-app"
    }

    stages {
        stage('Cloner le code') {
            steps {
                git url: 'https://github.com/mahayoussef12/SMSDigital_Laravel', branch: 'main'
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
            success {
                echo "🚀 Pipeline exécuté avec succès"
            }
            failure {
                echo "❌ Pipeline échoué"
            }
        }
}
