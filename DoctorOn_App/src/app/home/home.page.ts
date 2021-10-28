import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AlertController, LoadingController, ModalController, } from '@ionic/angular';
import { AuthService } from '../services/auth.service';
import { AuthGuardService } from './../services/auth-guard.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage implements OnInit {

  user: any = [];
  flag = false;

  aux_specialty: any = [];
  specialty: any = [];
  doctors: any = [];

  token = localStorage.getItem('token');

  constructor(
    private authService: AuthService,
    private authGuardService: AuthGuardService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private router: Router,
    public http: HttpClient,
    public modalController: ModalController,
  ) { }

  async ngOnInit() {
    this.onSpecialty();
    this.onProfile();
  }


  async onProfile() {
    const loading = await this.loadingCtrl.create({ message: 'Carregando...' });
    loading.present();

    this.authService.profile().subscribe(
      async users => {
        this.user = users.user;
        loading.dismiss();
        console.log(this.user);
      },
      async error => {
        const alert = await this.alertCtrl.create({
          header: 'Falha',
          message: error.error.message,
          buttons: [{
            text: 'OK',
            handler: () => { this.router.navigateByUrl('/login'); }
          }],
        });
        loading.dismiss();
        await alert.present();
        console.log(error.error);
      }
    );
  }

  async onSpecialty() {
    this.authService.specialties(this.token).subscribe(
      (specialty) => {
        this.aux_specialty = specialty['specialties'];
        this.specialty = this.aux_specialty;
      })
  }


  async onLogout() {
    const alert = await this.alertCtrl.create({
      header: 'Sair do Aplicativo',
      message: 'Deseja realmente sair?',
      buttons: [{
        text: 'Sim',
        handler: () => {
          this.flag = true;
          if (this.flag == true) {
            this.authService.logout().subscribe(
              async success => {
                localStorage.getItem('token');
                localStorage.clear();
                this.authGuardService.authInfo.authenticated = false;
                this.router.navigateByUrl('/login');
                console.log(success);
              },
              async error => {
                const alert = await this.alertCtrl.create({
                  header: 'Falha ao sair',
                  message: error.error.message,
                  buttons: ['OK']
                });
                localStorage.getItem('token');
                localStorage.clear();
                this.router.navigateByUrl('/login');
                await alert.present();
                console.log(error.error);
              }
            );
          }
        }
      },
      {
        text: 'Não',
        handler: () => {
          this.flag = false;
          this.router.navigateByUrl('/home');
        }
      }],
    });

    await alert.present();

  }

  public openPage(specialty) {
    this.router.navigateByUrl('/doctors', {
      state: specialty
    });
  }

}
