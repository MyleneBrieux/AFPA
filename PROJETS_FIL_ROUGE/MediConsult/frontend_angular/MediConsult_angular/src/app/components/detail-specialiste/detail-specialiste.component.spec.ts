import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailSpecialisteComponent } from './detail-specialiste.component';

describe('DetailSpecialisteComponent', () => {
  let component: DetailSpecialisteComponent;
  let fixture: ComponentFixture<DetailSpecialisteComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DetailSpecialisteComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailSpecialisteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
