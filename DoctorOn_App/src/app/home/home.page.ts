import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { async } from '@angular/core/testing';
import { Router } from '@angular/router';
import { AlertController, LoadingController, ToastController } from '@ionic/angular';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage implements OnInit {

  user: any = [];

  constructor(private authService: AuthService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private toastCtrl: ToastController,
    private router: Router,
    public http: HttpClient) { }

  async ngOnInit() {

    const loading = await this.loadingCtrl.create({ message: 'Carregando...' });
    loading.present();

    this.authService.profile().subscribe(
      async users => {
        this.user = users['user'];
        loading.dismiss();
        console.log(this.user);
      },
      async error => {
        const alert = await this.alertCtrl.create({
          header: 'Falha',
          message: error.error.message,
          buttons: [{
            text: 'OK',
            handler: () => { this.router.navigateByUrl('/login') }
          }],
        });
        loading.dismiss();
        await alert.present();
        console.log(error.error);
      }
    )
  }

  async onLogout() {
    this.authService.logout().subscribe(
      async success => {

        const alert = await this.alertCtrl.create({
          header: 'Sair do Aplicativo',
          message: 'Deseja realmente sair?',
          buttons: [{
            text: 'Sim',
            handler: () => {
              this.router.navigateByUrl('/login')
              localStorage.clear;
            }
          },
          {
            text: 'Não',
            handler: () => {
              this.router.navigateByUrl('/home')
            }
          }],
        });

        await alert.present();

        console.log(success);
      },
      async error => {
        const alert = await this.alertCtrl.create({
          header: 'Falha ao sair',
          message: error.error.message,
          buttons: ['OK']
        });
        await alert.present();
        console.log(error.error);
      }
    )
  }

}
