import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private url = environment.api;

  token = '';

  constructor(public http: HttpClient) {
    this.token = localStorage.getItem('token');

    if (this.token != '') {
      localStorage.clear();
    }
  }

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

  specialties(token): Observable<any> {
    if (this.token != '') {
      localStorage.clear();
      this.token = token;
    } else {
      this.token = token;
    }
    const headers = new HttpHeaders({ Authorization: 'Bearer ' + token });
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
