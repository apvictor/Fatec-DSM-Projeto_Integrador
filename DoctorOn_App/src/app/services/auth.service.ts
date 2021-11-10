import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private url = environment.api;
  private token = localStorage.getItem('token');

  constructor(public http: HttpClient) { }

  login(user: any): Observable<any> {
    return this.http.post(`${this.url}/login`, user);
  }

  register(user: any): Observable<any> {
    return this.http.post(`${this.url}/register`, user);
  }

  logout(): Observable<any> {
    const headers = new HttpHeaders({ Authorization: 'Bearer ' + this.token });
    return this.http.get(`${this.url}/logout`, { headers });
  }

  profile(): Observable<any> {
    const headers = new HttpHeaders({ Authorization: 'Bearer ' + this.token });
    return this.http.get(`${this.url}/profile`, { headers });
  }

  update(user: any, id: number) {
    const headers = new HttpHeaders({ Authorization: 'Bearer ' + this.token });
    return this.http.post(`${this.url}/profile/update/` + id, user, { headers });
  }

  units() {
    const headers = new HttpHeaders({ Authorization: 'Bearer ' + this.token });
    return this.http.get(`${this.url}/units`, { headers });
  }

  unitsDetails(id: number) {
    const headers = new HttpHeaders({ Authorization: 'Bearer ' + this.token });
    return this.http.get(`${this.url}/units/` + id, { headers });
  }

  specialties(): Observable<any> {
    const headers = new HttpHeaders({ Authorization: 'Bearer ' + this.token });
    return this.http.get(`${this.url}/specialties`, { headers });
  }

  doctors(specialty: string) {
    const headers = new HttpHeaders({ Authorization: 'Bearer ' + this.token });
    return this.http.get(`${this.url}/doctors/` + specialty, { headers });
  }

  forgotPassword(email: string) {
    return this.http.post(`${this.url}/reset/`, email);
  }



}
