package com.example.hca_doctorapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

public class MainActivity extends AppCompatActivity {

    ListView lv;

    public static int[] icons={R.drawable.ic_calendar, R.drawable.ic_google_meet_small, R.drawable.ic_doctor,R.drawable.ic_password,R.drawable.ic_logout};
    public static String[] mnuList={"Appointments","Video Conference Setup","Update Profile","Change Password","Logout"};


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
                if (mnuList[position].equals("Appointments")) {
                    Intent intent = new Intent(MainActivity.this, Appointments.class);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Video Conference Setup")) {
                    Intent intent = new Intent(MainActivity.this, SetGoogleMeet.class);
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
