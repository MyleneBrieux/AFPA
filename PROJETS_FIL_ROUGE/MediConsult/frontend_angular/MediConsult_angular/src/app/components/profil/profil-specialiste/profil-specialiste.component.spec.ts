import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ProfilSpecialisteComponent } from './profil-specialiste.component';

describe('ProfilSpecialisteComponent', () => {
  let component: ProfilSpecialisteComponent;
  let fixture: ComponentFixture<ProfilSpecialisteComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ProfilSpecialisteComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ProfilSpecialisteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
