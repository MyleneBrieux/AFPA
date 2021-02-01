import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SpecialistesComponent } from './specialistes.component';

describe('SpecialistesComponent', () => {
  let component: SpecialistesComponent;
  let fixture: ComponentFixture<SpecialistesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SpecialistesComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SpecialistesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
