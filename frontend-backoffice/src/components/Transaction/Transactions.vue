<template> 
  <div class="container mt-4">
    <div class="card shadow-lg rounded">
      <!-- Card Header stays the same -->
      <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3 px-4">
        <h4 class="mb-0">
          <i class="fas fa-wallet me-2"></i> Transactions
        </h4>
        <button 
          @click="fetchTransactions" 
          class="btn btn-light btn-sm"
          :disabled="loading"
        >
          <i class="fas fa-sync-alt me-1" :class="{ 'fa-spin': loading }"></i>
          Refresh
        </button>
      </div>

      <!-- Card Body -->
      <div class="card-body">
        <!-- Loading State -->
        <div v-if="loading" class="text-center my-4">
          <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
          <p>Loading transactions...</p>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="alert alert-danger">
          <i class="fas fa-exclamation-triangle me-2"></i> {{ error }}
        </div>

        <!-- Empty State -->
        <div v-else-if="transactions.length === 0" class="text-center my-4">
          <i class="fas fa-box-open fa-2x text-muted"></i>
          <p>No transactions found.</p>
        </div>

        <!-- Table State - Only show when not loading, no error, and has data -->
        <table v-else class="table table-hover table-bordered text-center">
          <thead class="table-dark">
            <tr>
              <th><i class="fas fa-user me-1"></i> User ID</th> 
              <th><i class="fas fa-calculator me-1"></i>Deposit</th>
              <th><i class="fas fa-calculator me-1"></i>Withdrawal</th>
              <th><i class="fas fa-calendar-alt me-1"></i>Date</th>
              <th><i class="fas fa-tasks me-1"></i> Status</th>
              <th><i class="fas fa-check-circle me-1"></i> Validated At</th>
              <th><i class="fas fa-cogs me-1"></i> Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="transaction in transactions" :key="transaction.id">
              <td class="user-cell">
                <div class="user-avatar">
                  <img 
                    :src="transaction.userImageUrl || defaultImageUrl"
                    :alt="'User ' + transaction.userId"
                    @error="handleImageError"
                    class="user-image"
                  />
                </div>
                {{ transaction.userId }}
              </td>
              <td class="text-success fw-bold">
                <i class="fas fa-arrow-up"></i> ${{ transaction.deposit.toFixed(2) }}
              </td>
              <td class="text-danger fw-bold">
                <i class="fas fa-arrow-down"></i> ${{ transaction.withdrawal.toFixed(2) }}
              </td>
              <td>{{ formatDate(transaction.dateTransaction) }}</td>
              <td>
                <span v-if="transaction.approvedByAdmin" class="badge bg-success">
                  <i class="fas fa-check-circle"></i> Approved
                </span>
                <span v-else class="badge bg-warning text-dark">
                  <i class="fas fa-hourglass-half"></i> Pending
                </span>
              </td>
              <td>
                {{ transaction.validatedAt ? formatDate(transaction.validatedAt) : 'Not validated' }}
              </td>
              <td>
                <button v-if="!transaction.approvedByAdmin" @click="validateTransaction(transaction.id, transaction.userId)" 
                  class="btn btn-sm btn-primary">
                  <i class="fas fa-check"></i> Validate
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import defaultUserImage from '@/assets/default-user.png';

export default {
  data() {
    return {
      transactions: [],
      loading: true,
      error: null,
      adminId: localStorage.getItem('id_admin'),
      defaultImageUrl: defaultUserImage,
      userImages: new Map(),
    };
  },
  methods: {
    async fetchUserImage(userId) {
      if (this.userImages.has(userId)) {
        return this.userImages.get(userId);
      }

      try {
        const response = await axios.get(`http://localhost:8099/front-office/api/users/${userId}/profile-image`);
        
        if (response.data && response.data.imageUrl) {
          this.userImages.set(userId, response.data.imageUrl);
          return response.data.imageUrl;
        }
        return null;
      } catch (error) {
        console.error(`Error fetching image for user ${userId}:`, error);
        return null;
      }
    },
    handleImageError(event) {
      event.target.src = this.defaultImageUrl;
    },
    async validateTransaction(transactionId, userId) {
      try {
        const response = await axios.get(`http://localhost:8099/front-office/api/transactions/validate`, {
          params: { transactionId, adminId: this.adminId }
        });
        
        alert("Transaction validated successfully! The user will be notified.");
        this.fetchTransactions(); 
      } catch (error) {
        alert("Error validating transaction. Please try again.");
      }
    },
    async fetchTransactions() {
      this.loading = true;
      this.error = null;
      try {
        const response = await axios.get('http://localhost:8099/front-office/api/transactions/all');
        this.transactions = response.data.data || [];
        
        // Fetch images for all transactions
        await Promise.all(
          this.transactions.map(async (transaction) => {
            transaction.userImageUrl = await this.fetchUserImage(transaction.userId);
            return transaction;
          })
        );
      } catch (err) {
        this.error = "Failed to load transactions. Please try again later.";
      } finally {
        this.loading = false;
      }
    },
    formatDate(dateString) {
      return new Date(dateString).toLocaleString();
    }
  },
  mounted() {
    this.fetchTransactions();
  }
};
</script>

<style scoped>
.user-cell {
  display: flex;
  align-items: center;
  gap: 10px;
}

.user-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  overflow: hidden;
  border: 2px solid #103a8e;
  background-color: #ffffff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.user-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Card */
.card {
  border-radius: 12px;
  overflow: hidden;
}

/* Table */
.table {
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.table th,
.table td {
  text-align: center;
  vertical-align: middle;
}

/* Header */
.card-header {
  border-bottom: 2px solid #dee2e6;
}

/* Badges */
.badge {
  font-size: 14px;
  padding: 8px;
}

/* Buttons */
.btn {
  transition: all 0.3s ease-in-out;
}

.btn:hover:not(:disabled) {
  transform: scale(1.05);
}
</style>