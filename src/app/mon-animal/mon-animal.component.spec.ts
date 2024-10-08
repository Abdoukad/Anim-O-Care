import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MonAnimalComponent } from './mon-animal.component';

describe('MonAnimalComponent', () => {
  let component: MonAnimalComponent;
  let fixture: ComponentFixture<MonAnimalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [MonAnimalComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(MonAnimalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
