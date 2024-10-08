import { Component } from '@angular/core';
import { faCalendarAlt, faUserMd, faSyringe, faPaw } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent {
  faCalendarAlt = faCalendarAlt;
  faUserMd = faUserMd;
  faSyringe = faSyringe;
  faPaw = faPaw;
}
