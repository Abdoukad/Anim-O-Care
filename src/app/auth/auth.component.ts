import { Component } from '@angular/core';
import { NgForm } from '@angular/forms';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.css']
})
export class AuthComponent {
  isLoginMode = true;
  isForgotPasswordMode = false;

  constructor(private authService: AuthService) {}

  switchMode() {
    if (this.isForgotPasswordMode) {
      this.isForgotPasswordMode = false;
      this.isLoginMode = true;
    } else {
      this.isLoginMode = !this.isLoginMode;
    }
  }

  onSubmit(form: NgForm) {
    if (!form.valid) {
      return;
    }
    const email = form.value.email;
    const password = form.value.password;

    if (this.isLoginMode) {
      this.authService.login(email, password).subscribe(
        responseData => {
          console.log('Connexion réussie', responseData);
        },
        error => {
          console.log('Erreur de connexion', error);
        }
      );
    } else {
      this.authService.signup(email, password).subscribe(
        responseData => {
          console.log('Inscription réussie', responseData);
        },
        error => {
          console.log('Erreur d\'inscription', error);
        }
      );
    }

    form.reset();
  }

  onForgotPassword() {
    this.isForgotPasswordMode = true;
  }
}
