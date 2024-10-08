import { Component } from '@angular/core';

@Component({
  selector: 'app-mon-animal',
  templateUrl: './mon-animal.component.html',
  styleUrls: ['./mon-animal.component.css']
})
export class MonAnimalComponent {
  animalName: string = '';
  animalSpecies: string = '';
  animalAge: string = '';
  animalImage: string = '';
  animals: any[] = [];

  onFileSelected(event: Event): void {
    const file = (event.target as HTMLInputElement).files?.[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = () => {
        this.animalImage = reader.result as string; // Image encodée en base64
      };
      reader.readAsDataURL(file);
    }
  }

  addAnimal(): void {
    const newAnimal = {
      name: this.animalName,
      species: this.animalSpecies,
      age: this.animalAge,
      image: this.animalImage || 'assets/default-animal.png' // Utilise une image par défaut si aucune n'est sélectionnée
    };
    this.animals.push(newAnimal);
    this.animalName = '';
    this.animalSpecies = '';
    this.animalAge = '';
    this.animalImage = '';
  }

  removeAnimal(animal: any): void {
    const index = this.animals.indexOf(animal);
    if (index > -1) {
      this.animals.splice(index, 1);
    }
  }
}
