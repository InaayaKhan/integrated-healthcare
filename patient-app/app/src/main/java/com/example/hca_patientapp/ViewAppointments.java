package com.example.hca_patientapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class ViewAppointments extends AppCompatActivity {

    ListView listView;

    ProgressDialog pDialog;

    JSONArray jsonArray = null;

    String[] url;
    String[] name;
    String[] desc;
    String[] status;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view_appointments);

        getSupportActionBar().setTitle("View My Appointments");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        listView=(ListView)findViewById(R.id.lvViewAppointment);

        // For populating list data
        new getMyAppointments().execute();

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int position, long l) {
                if (status[position].equalsIgnoreCase("Accepted")) {
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
            pDialog = new ProgressDialog(ViewAppointments.this);
            pDialog.setMessage("Loading... Please wait...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        protected String doInBackground(String...args){
            List<NameValuePair> params= new ArrayList<NameValuePair>();
            String url_user_details =  Common.server_url + "appGetMyAppointment.php";
            params.add(new BasicNameValuePair("id", Common.username));
            JSONParser jParser = new JSONParser();
            JSONObject json = jParser.makeHttpRequest(url_user_details, "POST", params);

            try {
                JSONArray cat=json.getJSONArray("response");
                url = new String[cat.length()];
                name = new String[cat.length()];
                desc = new String[cat.length()];
                status = new String[cat.length()];

                for(int i=0;i<cat.length();i++){
                    JSONObject jsonObject=cat.getJSONObject(i);
                    url[i]=jsonObject.getString("Website");
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
                CustomSearchResult cpl = new CustomSearchResult(ViewAppointments.this, name, desc,status,"appointment");
                listView.setAdapter(cpl);
            }
            pDialog.dismiss();
        }
    }
}