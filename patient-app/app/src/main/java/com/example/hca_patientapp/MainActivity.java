package com.example.hca_patientapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

public class MainActivity extends AppCompatActivity {

    ListView lv;

    public static int[] icons={R.drawable.ic_doctor, R.drawable.ic_chat, R.drawable.ic_calendar, R.drawable.ic_medical, R.drawable.ic_hospital, R.drawable.ic_govtscheme, R.drawable.ic_user,R.drawable.ic_password,R.drawable.ic_logout};
    public static String[] mnuList={"Search a Doctor","Chat Bot","View My Appointments","Nearby Medical Shop","Nearby Hospital","Govt. Schemes","Update Profile","Change Password","Logout"};


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        CustomAdapterMain customAdapter=new CustomAdapterMain(MainActivity.this,mnuList,icons);
        lv=(ListView)findViewById(R.id.listViewMain);
        lv.setAdapter(customAdapter);
        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                if (mnuList[position].equals("Search a Doctor")) {
                    Intent intent = new Intent(MainActivity.this, SearchDoctor.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Chat Bot")) {
                    Intent intent = new Intent(MainActivity.this, ChatActivity.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("View My Appointments")) {
                    Intent intent = new Intent(MainActivity.this, ViewAppointments.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Nearby Medical Shop")) {
                    Uri uri = Uri.parse("https://www.google.com/maps/search/pharmacy store near me/");
                    Intent intent = new Intent(Intent.ACTION_VIEW, uri);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Nearby Hospital")) {
                    Uri uri = Uri.parse("https://www.google.com/maps/search/hospital near me/");
                    Intent intent = new Intent(Intent.ACTION_VIEW, uri);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Govt. Schemes")) {
                    Intent intent = new Intent(MainActivity.this, GovtScheme.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Update Profile")) {
                    Intent intent = new Intent(MainActivity.this, UpdateProfile.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Change Password")) {
                    Intent intent = new Intent(MainActivity.this, ChangePassword.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Logout")) {
                    Intent intent = new Intent(MainActivity.this, Login.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                    finish();

                }
            }
        });

    }
}
