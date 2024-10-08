import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  constructor() {}

  // Méthode de connexion simulée
  login(email: string, password: string): Observable<any> {
    console.log('Connexion simulée avec', email, password);
    return of({ success: true, message: 'Connexion simulée réussie' });
  }

  // Méthode d'inscription simulée
  signup(email: string, password: string): Observable<any> {
    console.log('Inscription simulée avec', email, password);
    return of({ success: true, message: 'Inscription simulée réussie' });
  }

  // Méthode de réinitialisation de mot de passe simulée
  forgotPassword(email: string): Observable<any> {
    console.log('Réinitialisation simulée pour', email);
    return of({ success: true, message: 'Email de réinitialisation simulé envoyé' });
  }
}
