import './styles/main.scss';

class Greeter {
  private message: string;

  constructor(message: string) {
    this.message = message;
  }

  greet(name: string): void {
    console.log(`Hello, ${name}. ${this.message}`);
  }
}

const greeter: Greeter = new Greeter('Pleasure to meet you!');

greeter.greet('Junaid');
