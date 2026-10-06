package com.example.hca_doctorapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

public class Appointments extends AppCompatActivity {

    ListView lv;

    public static int[] icons={R.drawable.ic_calendar, R.drawable.ic_calendar, R.drawable.ic_calendar,R.drawable.ic_calendar,R.drawable.ic_calendar};
    public static String[] mnuList={"New Appointments","Today's Appointment","Upcoming Appointments","Appointment History","All Appointments"};


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_appointments);

        getSupportActionBar().setTitle("Appointments");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        CustomAdapterMain customAdapter=new CustomAdapterMain(Appointments.this,mnuList,icons);
        lv=(ListView)findViewById(R.id.listViewAppointment);
        lv.setAdapter(customAdapter);
        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                if (mnuList[position].equals("New Appointments")) {
                    Intent intent = new Intent(Appointments.this, AppointmentList.class);
                    Bundle b = new Bundle();
                    b.putString("Menu","New");
                    intent.putExtras(b);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Today's Appointment")) {
                    Intent intent = new Intent(Appointments.this, AppointmentList.class);
                    Bundle b = new Bundle();
                    b.putString("Menu","Today");
                    intent.putExtras(b);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Upcoming Appointments")) {
                    Intent intent = new Intent(Appointments.this, AppointmentList.class);
                    Bundle b = new Bundle();
                    b.putString("Menu","Upcoming");
                    intent.putExtras(b);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("Appointment History")) {
                    Intent intent = new Intent(Appointments.this, AppointmentList.class);
                    Bundle b = new Bundle();
                    b.putString("Menu","History");
                    intent.putExtras(b);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
                else if (mnuList[position].equals("All Appointments")) {
                    Intent intent = new Intent(Appointments.this, AppointmentList.class);
                    Bundle b = new Bundle();
                    b.putString("Menu","All");
                    intent.putExtras(b);
                    intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    startActivity(intent);
                }
            }
        });
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == android.R.id.home) {
            finish();
        }
        return super.onOptionsItemSelected(item);
    }
}