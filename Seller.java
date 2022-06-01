import java.sql.*;

public class Seller extends end_user
{
    Connection c = null;

    public Seller()
    {
        id = "";
        nama = "";
        username = "";
        password = "";
        location = "";
        amount = 0;
    }

    public void login(String username, String password)
    {
        try{
            c = DriverManager.getConnection("jdbc:postgresql://localhost:5432/TokoApp","postgres", "password");
            String sf = "SELECT * FROM public.seller WHERE users = ? AND pass = ?";
            PreparedStatement stmt = c.prepareStatement(sf);
            stmt.setObject(1, username);
            stmt.setObject(2, password);
            ResultSet rs = stmt.executeQuery();
            while(rs.next())
            {
                this.id = rs.getString("id_seller");
                this.nama = rs.getString("nama");
                this.location = rs.getString("lokasi");
                this.amount = rs.getDouble("amount");
                this.username = rs.getString("users");
                this.password = rs.getString("pass");
            }
            System.out.println("Login Succesfull!\n");

        } catch(SQLException e) {
            System.out.println("User not found!\n");
            System.out.println(e.getMessage());
        }
    }

    public void sign_up(String id, String nama, String username, String password, String location, double amount)
    {
        this.id = id;
        this.nama = nama;
        this.username = username;
        this.password = password;
        this.location = location;
        this.amount = amount;

        try{
            c = DriverManager.getConnection("jdbc:postgresql://localhost:5432/TokoApp","postgres", "password");
            String sf = "INSERT INTO public.seller(id_seller, nama, lokasi, amount, users, pass) VALUES(?,?,?,?,?,?)";
            PreparedStatement stmt = c.prepareStatement(sf);
            stmt.setObject(1, this.id);    
            stmt.setObject(2, this.nama);
            stmt.setObject(3, this.location);
            stmt.setObject(4, this.amount);
            stmt.setObject(5, this.username);
            stmt.setObject(6, this.password);
            stmt.execute();
            c.close();
            System.out.println("Data Saved Succesfully!");
            System.out.println("Choose 0 to Login!\n");
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
    }

    public void add_item()
    {

    }
    public void show_item()
    {

    }
    public void delete_item()
    {

    }
    public void selling_history()
    {

    }
    public void transfer_amount()
    {

    }
}