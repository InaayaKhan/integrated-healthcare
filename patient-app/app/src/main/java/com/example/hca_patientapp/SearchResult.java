package com.example.hca_patientapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class SearchResult extends AppCompatActivity {

    TextView tvName,tvSpecialized, tvCity;

    ListView listView;

    ProgressDialog pDialog;

    JSONArray jsonArray = null;

    String[] id;
    String[] name;
    String[] desc;

    String strName;
    String strSpecialized;
    String strCity;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_result);

        getSupportActionBar().setTitle("Search Result");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        Bundle bundle = getIntent().getExtras();
        strName= bundle.getString("Name");
        strSpecialized= bundle.getString("Specialized");
        strCity= bundle.getString("City");

        tvName = (TextView) findViewById(R.id.txtSearchResultName);
        tvSpecialized = (TextView) findViewById(R.id.txtSearchResultSpecialized);
        tvCity = (TextView) findViewById(R.id.txtSearchResultCity);

        if (strName.length()<=0)
        {
            strName = "Any";
        }

        if (strCity.length()<=0)
        {
            strCity = "Any";
        }

        //tvName.setText("Name: " + strName);
        tvSpecialized.setText("Specialized: " + strSpecialized);
        //tvCity.setText("City: " + strCity);

        listView=(ListView)findViewById(R.id.listViewSearchResult);

        // For populating list data
        new getSearchResult().execute();

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int position, long l) {
                String text = id[position].toString();
                Intent i = new Intent(getApplicationContext(), DoctorDetails.class);
                Bundle bundle = new Bundle();
                bundle.putString("DoctorID", text);
                i.putExtras(bundle);
                startActivity(i);
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

    class getSearchResult extends AsyncTask<String,String,String> {
        protected void onPreExecute(){
            super.onPreExecute();
            pDialog = new ProgressDialog(SearchResult.this);
            pDialog.setMessage("Searching... Please wait...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        protected String doInBackground(String...args){
            List<NameValuePair> params= new ArrayList<NameValuePair>();
            String url_user_details =  Common.server_url + "appGetSearchResult.php";
            params.add(new BasicNameValuePair("Name", strName));
            params.add(new BasicNameValuePair("Specialized", strSpecialized));
            params.add(new BasicNameValuePair("City", strCity));
            JSONParser jParser = new JSONParser();
            JSONObject json = jParser.makeHttpRequest(url_user_details, "POST", params);

            try {
                JSONArray cat=json.getJSONArray("response");
                id = new String[cat.length()];
                name = new String[cat.length()];
                desc = new String[cat.length()];

                for(int i=0;i<cat.length();i++){
                    JSONObject jsonObject=cat.getJSONObject(i);
                    id[i]=jsonObject.getString("ID");
                    name[i]=jsonObject.getString("Name");
                    desc[i]=jsonObject.getString("Description");
                }
            }catch (JSONException e){
                e.printStackTrace();
            }

            return null;
        }

        protected void onPostExecute(String file_url){

            for(int i=0;i<name.length;i++){
                CustomSearchResult cpl = new CustomSearchResult(SearchResult.this, name, desc, null,"search");
                listView.setAdapter(cpl);
            }
            pDialog.dismiss();
        }
    }
}