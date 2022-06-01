public abstract class end_user
{
    protected String id;
    protected String nama;
    protected String username;
    protected String password;
    protected String location;
    protected double amount;

    abstract public void sign_up(String id, String nama, String username, String password, String location, double amount);
    abstract public void login(String username, String password);
}