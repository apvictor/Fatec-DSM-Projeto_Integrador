import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { AlertController, LoadingController, NavParams, ToastController } from '@ionic/angular';
import { AuthService } from '../services/auth.service';
import { Geolocation } from '@ionic-native/geolocation/ngx';

@Component({
  selector: 'app-doctors',
  templateUrl: './doctors.page.html',
  styleUrls: ['./doctors.page.scss'],
})
export class DoctorsPage implements OnInit {
  doctors: any;
  dataValue: any;

  latUser;
  longUser;
  km;

  specialty;
  count;

  unidade: any[];
  aux_unidade: any = [];

  minhaPosicao: google.maps.LatLng;
  unitPosicao: google.maps.LatLng;


  constructor(
    private geolacation: Geolocation,
    private authService: AuthService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private toastCtrl: ToastController,
    private router: Router,
    public http: HttpClient,
    private route: ActivatedRoute,

  ) {
    let data = this.router.getCurrentNavigation();
    this.dataValue = data.extras.state;
  }


  ngOnInit() {
    this.localizaUser();
  }

  async localizaUser() {
    const loading = await this.loadingCtrl.create({ message: 'Buscando Médicos...' });
    loading.present();
    this.geolacation.getCurrentPosition({
      timeout: 10000,
      enableHighAccuracy: true
    }).then((res) => {
      this.minhaPosicao = new google.maps.LatLng(res.coords.latitude, res.coords.longitude);
      console.log(res.coords.latitude, res.coords.longitude);
      this.localizaDoctor();
      loading.dismiss();
    }).catch((e) => {
      this.localizaDoctor();
      console.log(e);
      loading.dismiss();
    })
  }

  async localizaDoctor() {
    this.authService.doctors(this.dataValue).subscribe((doctor) => {
      this.aux_unidade = doctor['doctor'];

      this.count = this.aux_unidade.length;

      // Incluir resultado do km no objeto
      for (let i = 0; i < this.aux_unidade.length; i++) {

        this.unitPosicao = new google.maps.LatLng(this.aux_unidade[i].latitude, this.aux_unidade[i].longitude);
        this.km = (google.maps.geometry.spherical.computeDistanceBetween(this.minhaPosicao, this.unitPosicao) / 1000).toFixed(2);

        this.aux_unidade[i].km = parseFloat(this.km);


        if (this.dataValue != 'todos') {
          this.specialty = this.aux_unidade[i].specialty;
        } else {
          this.specialty = 'Todas Especialidades';
        }
      }

      // Buscar pelo menor km
      this.aux_unidade = this.aux_unidade.sort(function (a, b) {
        if (a.km < b.km) { return -1; }
        if (a.km > b.km) { return 1; }
        return 0;
      });


      // Retornar para visualização na tela
      this.doctors = this.aux_unidade;
    })
  }


}
