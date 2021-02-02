import { Time } from "@angular/common";

export interface PatientModele {
  id: number;
  date: Date;
  horaire: Time;
  specialiste: number;
  patient: number;
}
