pipeline {
    agent anystages{
       stage("checkout") {
            steps{
                ... // in this stage, I put the git repository that will be pulled.
            }
        }
        stage("build") {
            steps{
                sh '''./gradlew build clean'''
                echo "The build stage passed..."
            }
        }
        stage("test") {
            steps{
                echo "The test stage passed..."
            }
        }
    }post{
        always{
            echo "post-build will always run after build completed"
            // Jenkins cleans the workspace
            cleanWs()  
        }
    }
}
