import { Injectable } from '@angular/core';
import { Router, CanActivate, ActivatedRouteSnapshot } from "@angular/router";

@Injectable({
  providedIn: 'root'
})
export class AuthGuardService {

  authInfo = {
    authenticated: false
  };

  constructor(private router: Router) { }

  canActivate(route: ActivatedRouteSnapshot): boolean {
    console.log(route);
    if (!this.authInfo.authenticated) {
      this.router.navigate(["login"]);
      return false;
    }
    return true;
  }
}
