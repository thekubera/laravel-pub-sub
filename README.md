## Laravel Kafka Pub-Sub Application

This repository demonstrates a Producer-Consumer setup using Apache Kafka. The application consists of two main components:

- A producer that sends messages to a Kafka topic.
- A consumer that reads messages from the Kafka topic.

**It utilizes two separate Laravel applications for producer and consumer functionality.**

### Prerequisites

- Docker
- Docker Compose

### Getting Started

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/thekubera/laravel-pub-sub
   ```

2. **Start Services:**

   Navigate to the project directory and execute the following command to initiate the Docker containers:

   ```bash
   docker compose up
   ```

3. **Copy and Adjust Environment Files:**

   Once the build and startup are successful, copy the `.env.example` file to `.env` for both the producer and consumer Laravel applications, and make any necessary adjustments:

   **For Producer:**

   ```bash
   docker exec <producer-container-name> cp .env.example .env
   ```

   **For Consumer:**

   ```bash
   docker exec <consumer-container-name> cp .env.example .env
   ```

   **Note:** Replace `<producer-container-name>` and `<consumer-container-name>` with the actual container names obtained from `docker-compose ps`.

4. **Generate Laravel Application Keys:**

   Generate application keys for both the producer and consumer Laravel applications:

   **For Producer:**

   ```bash
   docker exec <producer-container-name> php artisan key:generate
   ```

   **For Consumer:**

   ```bash
   docker exec <consumer-container-name> php artisan key:generate
   ```

5. **Access Producer Interface:**

   Open your web browser and navigate to `http://localhost:8000/producer/` to interact with the message producer.

6. **Consume Messages:**

   To consume messages from the Kafka topic, run the following command in a separate terminal window:

   ```bash
   docker exec <consumer-container-name> php artisan kafka:consume
   ```

### Code Exploration

For understanding the producer and consumer logic, explore the following files:

- `ProducerController.php` (Producer application)
- `KafkaConsumerCommand.php` (Consumer application)

### Additional Notes

- Ensure the Docker containers are running while accessing the producer interface and consuming messages.
- This is a simple illustration of how messages can be published and subscribed to using Kafka. Additional considerations may be necessary depending on your specific requirements.

### Contributions

This is a basic example to get you started with a Laravel Kafka Pub-Sub application. As you might see, it currently just produces a simple "Hello World!" message.

**Want to enhance it? Feel free to contribute!**

We welcome your contributions through issues and pull requests to make this Kafka Pub-Sub application even better!