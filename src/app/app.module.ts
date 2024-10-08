import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';

import { AppComponent } from './app.component';
import { AuthComponent } from './auth/auth.component';
import { HomeComponent } from './home/home.component';
import { FooterComponent } from './footer/footer.component';
import { MonAnimalComponent } from './mon-animal/mon-animal.component';
import { NavbarComponent } from './navbar/navbar.component';
import { ChatbotComponent } from './chatbot/chatbot.component'; // Import du composant Chatbot

@NgModule({
  declarations: [
    AppComponent,
    AuthComponent,
    HomeComponent,
    FooterComponent,
    MonAnimalComponent,
    NavbarComponent,
    ChatbotComponent // Ajout du composant Chatbot ici
  ],
  imports: [
    BrowserModule,
    FormsModule,
    FontAwesomeModule,
    HttpClientModule,
    RouterModule.forRoot([
      { path: '', component: AuthComponent },       // Page par défaut : Authentification
      { path: 'home', component: HomeComponent },   // Page d'accueil
      { path: 'mon-animal', component: MonAnimalComponent }, // Page Mon Animal
      { path: 'chatbot', component: ChatbotComponent } // Page Chatbot
    ])
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
