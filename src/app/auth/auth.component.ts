import { Component } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.css']
})
export class AuthComponent {
  isLoginMode = true;
  isForgotPasswordMode = false;

  constructor(private authService: AuthService, private router: Router) {}

  // Change le mode entre Connexion et Inscription
  switchMode() {
    if (this.isForgotPasswordMode) {
      this.isForgotPasswordMode = false;
      this.isLoginMode = true;
    } else {
      this.isLoginMode = !this.isLoginMode;
    }
  }

  // Soumission du formulaire pour Connexion ou Inscription
  onSubmit(form: NgForm) {
    if (!form.valid) {
      return;
    }
    const email = form.value.email;
    const password = form.value.password;

    if (this.isLoginMode) {
      // Mode connexion simulée
      this.authService.login(email, password).subscribe(
        responseData => {
          console.log('Connexion réussie', responseData);
          this.router.navigate(['/home']); // Redirige vers la page d'accueil après connexion
        },
        error => {
          console.log('Erreur de connexion', error);
        }
      );
    } else {
      // Mode inscription simulée
      this.authService.signup(email, password).subscribe(
        responseData => {
          console.log('Inscription réussie', responseData);
          this.router.navigate(['/home']); // Redirige vers la page d'accueil après inscription
        },
        error => {
          console.log('Erreur d\'inscription', error);
        }
      );
    }

    form.reset();
  }

  // Gère le formulaire de réinitialisation de mot de passe
  onForgotPassword(form?: NgForm) {
    if (form && form.valid) {
      const email = form.value.email;
      this.authService.forgotPassword(email).subscribe(
        response => {
          console.log('Email de réinitialisation envoyé', response);
        },
        error => {
          console.error('Erreur de réinitialisation', error);
        }
      );
      form.reset();
    } else {
      this.isForgotPasswordMode = true; // Active le mode de réinitialisation de mot de passe
    }
  }
}
