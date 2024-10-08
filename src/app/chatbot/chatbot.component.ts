import { Component } from '@angular/core';

@Component({
  selector: 'app-chatbot',
  templateUrl: './chatbot.component.html',
  styleUrls: ['./chatbot.component.css']
})
export class ChatbotComponent {
  userMessage: string = '';
  messages: { text: string, sender: 'user' | 'bot' }[] = [];

  sendMessage(): void {
    if (this.userMessage.trim()) {
      this.messages.push({ text: this.userMessage, sender: 'user' });
      this.userMessage = '';
      this.generateBotResponse();
    }
  }

  generateBotResponse(): void {
    // Réponse de simulation - à remplacer par une réponse de l'API
    const botReply = "Merci pour votre question ! Comment puis-je vous aider encore ?";
    setTimeout(() => {
      this.messages.push({ text: botReply, sender: 'bot' });
    }, 500); // Légère pause pour l'effet naturel de réponse
  }
}
