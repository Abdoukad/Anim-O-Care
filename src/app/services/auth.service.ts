import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  // URL de l'API backend pour chaque opération
  private signupUrl = 'https://votre-backend-url/api/register';
  private loginUrl = 'https://votre-backend-url/api/login';
  private forgotPasswordUrl = 'https://votre-backend-url/api/forgot-password';

  constructor(private http: HttpClient) {}

  // Méthode pour inscrire un nouvel utilisateur
  signup(email: string, password: string): Observable<any> {
    return this.http.post(this.signupUrl, { email, password });
  }

  // Méthode pour connecter un utilisateur existant
  login(email: string, password: string): Observable<any> {
    return this.http.post(this.loginUrl, { email, password });
  }

  // Méthode pour réinitialiser le mot de passe de l'utilisateur
  forgotPassword(email: string): Observable<any> {
    return this.http.post(this.forgotPasswordUrl, { email });
  }
}
