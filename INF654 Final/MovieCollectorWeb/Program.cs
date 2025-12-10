var builder = WebApplication.CreateBuilder(args);
var app = builder.Build();

app.UseDefaultFiles(); // Enables default file mapping like index.html or collection.html
app.UseStaticFiles();  // Enables serving files from wwwroot

app.Run();
