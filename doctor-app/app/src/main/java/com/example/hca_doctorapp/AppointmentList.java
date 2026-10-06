package com.example.hca_doctorapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class AppointmentList extends AppCompatActivity {

    ListView listView;

    ProgressDialog pDialog;

    JSONArray jsonArray = null;

    String[] url;
    String[] name;
    String[] desc;
    String[] status;
    String[] id;

    String strMenu;

    String urlAppointment="";

    String strAppointmentStatus="";
    String strID="";

    JSONParser jsonParser = new JSONParser();

    // url to create new product
    private static String url_update_status = Common.server_url + "/appupdateappointmentstatus_doctor.php";

    // JSON Node names
    private static final String TAG_SUCCESS = "success";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_appointment_list);

        getSupportActionBar().setTitle("View My Appointments");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        Bundle bundle = getIntent().getExtras();
        strMenu= bundle.getString("Menu");

        listView=(ListView)findViewById(R.id.lvViewAppointment);

        urlAppointment = Common.server_url + "appDocAppointment.php";

        strAppointmentStatus = "Pending";

        // For populating list data
        new getMyAppointments().execute();

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int position, long l) {
                if (status[position].equalsIgnoreCase("Pending"))
                {
                    AlertDialog alertDialog = new AlertDialog.Builder(AppointmentList.this)
                            .setIcon(android.R.drawable.ic_dialog_alert)
                            .setTitle("Change Appointment Status")
                            .setMessage("Set the new appointment status for " + name[position])
                            .setPositiveButton("Accept", new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialogInterface, int i) {
                                    strAppointmentStatus="Accepted";
                                    strID=id[position];
                                    new funChangeAppointmentStatus().execute();
                                }
                            })
                            .setNegativeButton("Reject", new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialogInterface, int i) {
                                    strAppointmentStatus="Rejected";
                                    strID=id[position];
                                    new funChangeAppointmentStatus().execute();
                                }
                            }).show();
                }
                else if (status[position].equalsIgnoreCase("Accepted")) {
                    Uri uri = Uri.parse("https://" + url[position].toString());
                    Intent intent = new Intent(Intent.ACTION_VIEW, uri);
                    startActivity(intent);
                    //Toast.makeText(getApplicationContext(),url[position],Toast.LENGTH_LONG).show();
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

    class getMyAppointments extends AsyncTask<String,String,String> {
        protected void onPreExecute(){
            super.onPreExecute();
            pDialog = new ProgressDialog(AppointmentList.this);
            pDialog.setMessage("Loading... Please wait...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        protected String doInBackground(String...args){
            List<NameValuePair> params= new ArrayList<NameValuePair>();
            params.add(new BasicNameValuePair("id", Common.username));
            params.add(new BasicNameValuePair("menu", strMenu));
            JSONParser jParser = new JSONParser();
            JSONObject json = jParser.makeHttpRequest(urlAppointment, "POST", params);

            try {
                JSONArray cat=json.getJSONArray("response");
                url = new String[cat.length()];
                id = new String[cat.length()];
                name = new String[cat.length()];
                desc = new String[cat.length()];
                status = new String[cat.length()];

                for(int i=0;i<cat.length();i++){
                    JSONObject jsonObject=cat.getJSONObject(i);
                    url[i]=jsonObject.getString("Website");
                    id[i]=jsonObject.getString("ID");
                    name[i]=jsonObject.getString("Name");
                    desc[i]=jsonObject.getString("Description");
                    status[i]=jsonObject.getString("Status");
                }
            }catch (JSONException e){
                e.printStackTrace();
            }

            return null;
        }

        protected void onPostExecute(String file_url){

            for(int i=0;i<name.length;i++){
                CustomSearchResult cpl = new CustomSearchResult(AppointmentList.this, name, desc,status,"appointment");
                listView.setAdapter(cpl);
            }
            pDialog.dismiss();
        }
    }

    class funChangeAppointmentStatus extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(AppointmentList.this);
            pDialog.setMessage("Updating Appointment Status.. Please Wait..");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }
        protected String doInBackground(String... args) {
            List<NameValuePair> params = new ArrayList<NameValuePair>();
            params.add(new BasicNameValuePair("id", strID));
            params.add(new BasicNameValuePair("status", strAppointmentStatus));
            JSONObject json = jsonParser.makeHttpRequest(url_update_status, "POST", params);
            try {
                int success = json.getInt(TAG_SUCCESS);
                final String message = json.getString("message");
                if (success == 1) {
                    Handler handler =  new Handler(getApplicationContext().getMainLooper());
                    handler.post( new Runnable(){
                        public void run(){
                            Toast.makeText(getApplicationContext(), message,Toast.LENGTH_SHORT).show();
                        }
                    });
                    Intent i = new Intent(getApplicationContext(), Appointments.class);
                    startActivity(i);
                    finish();
                } else {
                    Handler handler =  new Handler(getApplicationContext().getMainLooper());
                    handler.post( new Runnable(){
                        public void run(){
                            Toast.makeText(getApplicationContext(),message, Toast.LENGTH_LONG).show();
                        }
                    });
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
            return null;
        }
        protected void onPostExecute(String file_url) {
            // dismiss the dialog once done
            pDialog.dismiss();
            new getMyAppointments().execute();
        }
    }
}