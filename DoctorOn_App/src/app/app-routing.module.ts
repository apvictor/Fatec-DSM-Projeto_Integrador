import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { AuthGuardService } from './services/auth-guard.service';

const routes: Routes = [

  { path: '', redirectTo: 'login', pathMatch: 'full' },

  { path: 'login', loadChildren: () => import('./auth/login/login.module').then(m => m.LoginPageModule) },
  { path: 'register', loadChildren: () => import('./auth/register/register.module').then(m => m.RegisterPageModule) },
  { path: 'forgot-password', loadChildren: () => import('./auth/forgot-password/forgot-password.module').then(m => m.ForgotPasswordPageModule) },

  { path: 'home', loadChildren: () => import('./home/home.module').then(m => m.HomePageModule), canActivate: [AuthGuardService] },
  { path: 'units', loadChildren: () => import('./units/units.module').then(m => m.UnitsPageModule), canActivate: [AuthGuardService] },
  { path: 'profile', loadChildren: () => import('./profile/profile.module').then(m => m.ProfilePageModule), canActivate: [AuthGuardService] },
  { path: 'doctors', loadChildren: () => import('./doctors/doctors.module').then(m => m.DoctorsPageModule), canActivate: [AuthGuardService] },
];

@NgModule({
  imports: [RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
