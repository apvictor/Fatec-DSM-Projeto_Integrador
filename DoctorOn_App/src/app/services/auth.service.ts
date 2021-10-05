import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class AuthService {

    private url = 'http://127.0.0.1:8000/api';
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

}

